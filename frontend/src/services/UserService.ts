import api from "./api";

class UserService {

    static async get() {
        const response = await api.get("/me");
        return response.data;
    }

    static async getAchievements() {
        const response = await api.get("/achievement");
        return response.data;
    }

    static async getUserAchievement() {
        const response = await api.get(`/user-achievement`);
        return response.data;
    }
}

export default UserService;