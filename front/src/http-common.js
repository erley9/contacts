import axios from "axios";

const instance = axios.create({
    baseURL: "http://localhost:8989/api",
    headers: {
      "Accept":"application/json",
      "Content-type": "application/json"
    }
});

instance.interceptors.request.use(
  (config) => {
    const token = localStorage.getItem('accesstoken');
    if (token) {
      config.headers['Authorization'] = `Bearer ${token}`;
    }

    const language = localStorage.getItem("language") || "en";

    config.headers['Accept-Language'] = language;

    return config;
  },

  (error) => {
    return Promise.reject(error);
  }
);

export default instance 