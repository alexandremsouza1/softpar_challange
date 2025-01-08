import api from "./api";

class AuthenticationService {
    static signin(email:string, password:string) {
        return new Promise(async (resolve, reject) => {
            try {
                const response = await api.post("/auth", { email, password });
                const token = response?.data?.token;
                api.defaults.headers.common["Authorization"] = `Bearer ${token}`;
                resolve(token);
            } catch (error) {
                reject(error);
            }
        });
    }

    static signout() {
        return new Promise(async (resolve, reject) => {
            try {
                await api.post("/logout");
                setTimeout(() => {
                    delete api.defaults.headers.common["Authorization"];
                    resolve(true);
                }, 3000);
            } catch (error) {
                reject(error);
            }
        });
    }
}

export default AuthenticationService;
