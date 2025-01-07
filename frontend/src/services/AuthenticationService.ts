import api from "./api";

class AuthenticationService {
    static async signin(email: string, password: string) {
        const response = await api.post("/auth", { email, password });
        
        return response;
    }
}

export default AuthenticationService;
