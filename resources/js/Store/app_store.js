import { defineStore } from "pinia";

export const appStore = defineStore({
    id: "appStore",
    state: () => ({
        isAlert: false,
    }),
    actions: {
        showAlert() {
            this.isAlert = true;
            alert("Welcome to note app!");
            console.log("alert", this.isAlert);
        },
    },
});
