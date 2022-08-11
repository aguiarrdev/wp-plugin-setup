import { Notification } from "../../components/Notification";

class About {
  constructor() {
    if (!document.querySelector(".wpt-container-about")) return;
    this.handleNotification();
  }

  handleNotification(): void {
    setTimeout(() => {
      new Notification("Hello World!", "This is a example notification", 5);
    }, 1000);
  }
}

new About;