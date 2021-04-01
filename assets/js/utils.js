class Utils {
    static API_URL = "https://ciliweb.vn/coursework/api.php";
    constructor() {

    }
    static api(action, data = {}) {
        return new Promise((resolve, reject) => {
            console.log("send api");
            data["action"] = action;
            $.post(this.API_URL, data).then(response => {
                if (response['error'] !== 0) {
                    reject(response);
                } else resolve(response);
            }).fail(reject);
        });
    }
}