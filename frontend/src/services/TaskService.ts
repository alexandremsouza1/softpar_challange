import api from "./api";

class TaskService {
    static async getTasks() {
        const response = await api.get("/task");
        return response.data;
    }

    static async detail(id: number) {
        const response = await api.get(`/task/${id}`);
        return response.data;
    }

    static async create(taskData) {
        const response = await api.post("/task", taskData);
        return response.data;
    }

    static async update(taskData) {
        const response = await api.put(`/task/${taskData.id}`, taskData);
        return response.data;
    }

    static async delete(id: number) {
        const response = await api.delete(`/task/${id}`);
        return response.data;
    }

    static async delayed() {
        const response = await api.get("/task/delayed");
        return response.data;
    }
}

export default TaskService;
