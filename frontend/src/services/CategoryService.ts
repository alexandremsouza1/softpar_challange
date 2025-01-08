import api from "./api";

class CategoryService {


    static async getAll() {
        try {
            const response = await api.get("/category");
            return response?.data;
        } catch (error) {
            console.error(error);
            return [];
        }
    }

    static async create(category) {
        try {
            const response = await api.post("/category", category);
            return response?.data;
        } catch (error) {
            console.error(error);
            return null;
        }
    }

    static async update(category) {
        try {
            const response = await api.put(`/category/${category.id}`, category);
            return response?.data;
        } catch (error) {
            console.error(error);
            return null;
        }
    }

    static async delete(id) {
        try {
            const response = await api.delete(`/category/${id}`);
            return response?.data;
        } catch (error) {
            console.error(error);
            return null;
        }
    }

}

export default CategoryService;