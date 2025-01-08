import axios from "axios";

const api = axios.create({
    baseURL: import.meta.env.VITE_API,
    headers: {
        "Content-Type": "application/json",
    },
});

api.interceptors.request.use(
    (config) => {
        const local = localStorage.getItem("softpar") || "{}";
        const token = JSON.parse(local).accessToken;
        if (token) {
            config.headers.Authorization = `Bearer ${token}`;
        }
        return config;
    },
    (error) => {
        return Promise.reject(error);
    }
);

export default api;