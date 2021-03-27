//
//  AppDelegate.swift
//  KAnime
//
//  Created by LeDo on 5/20/20.
//  Copyright © 2020 LeDo. All rights reserved.
//

import UIKit
import Firebase
import GoogleMobileAds

@UIApplicationMain
class AppDelegate: UIResponder, UIApplicationDelegate {

    var window: UIWindow?
    private var lastUseApp:Date?
    private var appOpenAd: GADAppOpenAd?
    private var loadTime = Date()
    private var isShowRate = false

    func application(_ application: UIApplication, didFinishLaunchingWithOptions launchOptions: [UIApplication.LaunchOptionsKey: Any]?) -> Bool {
        // Override point for customization after application launch.
        FirebaseApp.configure()
        // Initialize the Google Mobile Ads SDK.
        GADMobileAds.sharedInstance().start(completionHandler: nil)
        return true
    }
    
    func applicationDidBecomeActive(_ application: UIApplication) {
        
        guard let date = lastUseApp else {
            tryToPresentAd()
            return
        }
        //reload ads because it only valid 4 hours
        if Date().timeIntervalSince(date) > 60*60*4 {
            window?.rootViewController =  UIStoryboard(name: "Main", bundle: nil).instantiateInitialViewController()
        } else {
            tryToPresentAd()
        }
        
    }

    func applicationWillResignActive(_ application: UIApplication) {
        lastUseApp = Date()
    }
    
    func tryToPresentAd() {
        
        let formatter = DateFormatter()
        formatter.dateFormat = "yyyy/MM/dd"
        if let someDateTime = formatter.date(from: showInterstitialDate) {
            if Date().timeIntervalSince(someDateTime) < 0 {
                print("not yet")
                return
            }
        }
        
        if let someDateTime = formatter.date(from: endShowRate) {
            if Date().timeIntervalSince(someDateTime) > 0 {
                print("not yet")
                return
            }
        }
        
        guard let rootVC = self.window?.rootViewController  else {
            return
        }
        
        if let gOpenAd = self.appOpenAd, wasLoadTimeLessThanNHoursAgo(thresholdN: 4) {
            gOpenAd.present(fromRootViewController: rootVC.topMostViewController())
        } else {
            self.requestAppOpenAd()
        }
        
    }
    
    func requestAppOpenAd() {
        
        appOpenAd = nil
        GADAppOpenAd.load(withAdUnitID: kOpenAdsId,
                          request: GADRequest(),
                          orientation: UIInterfaceOrientation.portrait,
                          completionHandler: { (appOpenAdIn, error) in
                            
                            if let er = error {
                                print("Failed to load app open ad: \(er.localizedDescription)")
                                return
                            }
                            
                            self.appOpenAd = appOpenAdIn
                            self.appOpenAd?.fullScreenContentDelegate = self
                            self.loadTime = Date()
                            
                          })
        
    }
    
    func wasLoadTimeLessThanNHoursAgo(thresholdN: Int) -> Bool {
        let now = Date()
        let timeIntervalBetweenNowAndLoadTime = now.timeIntervalSince(self.loadTime)
        let secondsPerHour = 3600.0
        let intervalInHours = timeIntervalBetweenNowAndLoadTime / secondsPerHour
        return intervalInHours < Double(thresholdN)
    }
    
    func showRate(){
        
        if isShowRate{
            return
        }
        
        isShowRate = true
        
        if #available(iOS 14, *) {
            Global.shared.requestRate()
        }
        
    }
    
}

//MARK: - GADFullScreenContentDelegate

extension AppDelegate: GADFullScreenContentDelegate{
    
    func ad(_ ad: GADFullScreenPresentingAd, didFailToPresentFullScreenContentWithError error: Error) {
        print("didFailToPresentFullScreenContentWithError \(error.localizedDescription)");
        self.requestAppOpenAd()
        showRate()
    }
    
    func adDidPresentFullScreenContent(_ ad: GADFullScreenPresentingAd) {
        print("adDidPresentFullScreenContent")
    }
    
    func adDidDismissFullScreenContent(_ ad: GADFullScreenPresentingAd) {
        print("adDidDismissFullScreenContent")
        self.requestAppOpenAd()
        showRate()
    }
    
}


extension UIViewController {
    @objc func topMostViewController() -> UIViewController {
        // Handling Modal views
        if let presentedViewController = self.presentedViewController {
            return presentedViewController.topMostViewController()
        }
        // Handling UIViewController's added as subviews to some other views.
        else {
            for view in self.view.subviews
            {
                // Key property which most of us are unaware of / rarely use.
                if let subViewController = view.next {
                    if subViewController is UIViewController {
                        let viewController = subViewController as! UIViewController
                        return viewController.topMostViewController()
                    }
                }
            }
            return self
        }
    }
}

extension UITabBarController {
    override func topMostViewController() -> UIViewController {
        return self.selectedViewController!.topMostViewController()
    }
}

extension UINavigationController {
    override func topMostViewController() -> UIViewController {
        return self.visibleViewController!.topMostViewController()
    }
}
