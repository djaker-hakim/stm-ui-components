window.$stm.tabs = (id, data, config = []) => {
  return {
    id: id,
    tabs: data, // array of object label, value, target, disabled
    activeTab: "",
    init() {
      $stm.register(this);
      this.$watch("activeTab", (value) => {
        this.tabs.forEach((tab) => {
          if (tab.value == this.activeTab) {
            document.querySelector(tab.target).removeAttribute("style");
          } else {
            document
              .querySelector(tab.target)
              .setAttribute("style", "display:none;");
          }
        });
      });
      this.activateDefault();
    },
    activate(value) {
      if (value == "unknown") {
        this.activeTab = value;
        return;
      }
      if (this.checkIfDisabled(this.findTab(value))) return;
      this.activeTab = value;
    },
    findTab(value) {
      let [tab] = this.tabs.filter((tab) => {
        return tab.value == value;
      });
      return tab;
    },
    disable(value) {
      let tab = this.findTab(value);
      tab.disabled = true;
      if (this.activeTab == tab.value) {
        this.activateDefault();
      }
    },
    enable(value) {
      let tab = this.findTab(value);
      tab.disabled = false;
      if (this.activeTab == "unknown") this.activate(tab.value);
    },
    checkIfDisabled(tab) {
      if (tab.hasOwnProperty("disabled")) return tab.disabled == true;
      return false;
    },
    getDefaultTab() {
      let defaultTab = { value: "unknown" };
      for (let i = 0; i < this.tabs.length; i++) {
        if (!this.checkIfDisabled(this.tabs[i])) {
          defaultTab = this.tabs[i];
          break;
        }
      }
      return defaultTab;
    },
    activateDefault() {
      this.activate(this.getDefaultTab().value);
    },
  };
};
