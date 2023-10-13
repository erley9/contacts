import http from "../http-common";

class AuthDataService {

  login(data) {
    return http.post("/login", data);
  }

  register(data) {
    return http.post("/register", data);
  }

  logout() {
    return http.post("/logout");
  }
}

export default new AuthDataService();