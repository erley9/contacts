import { defineStore } from 'pinia'
import ContactDataService from '../services/ContactDataService'

export const useContacts = defineStore('contacts', {
  state: () => {
    return {
        pagination: [],
        list: [],
        page: 1
    }
  },
  getters: {
  },
  actions: {
    // any amount of arguments, return a promise or not
    async getContacts(page:number) {
     const contacts = await ContactDataService.getPaginate(page);
     this.pagination = contacts.data.meta;
     this.list = contacts.data.data;
    },
    async saveContact(data:Array<any>) {
      const result = await ContactDataService.create(data);
      return result;
    },
    async updateContact(data:Array<any>, id:number) {
      const result = await ContactDataService.update(id,data);
      return result;
    },
    async deleteContact(id:number) {
      const result = await ContactDataService.delete(id);
      return result;
    }
  },
})