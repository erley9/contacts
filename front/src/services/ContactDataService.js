import http from "../http-common";

class ContactDataService {
  getPaginate(page = null) {

    let url = "/contact";

    if (page) {
      url = "/contact?page="+page;
    }

    return http.get(url);
  }

  get(id) {
    return http.get(`/contact/${id}`);
  }

  create(data) {
    return http.post("/contact", data);
  }

  update(id, data) {
    return http.put(`/contact/${id}`, data);
  }

  delete(id) {
    return http.delete(`/contact/${id}`);
  }
}

export default new ContactDataService();