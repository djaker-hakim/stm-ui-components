
// $stm is js object that controls all components.
// available Methods: component(id), allComponents(), open(id), close(id), toggle(id), getState(id)
// Note for nested components you need to use the Alpinejs $nextTick() method so all components will load properly  


window.$stm = {
    list: [],
    register(component) {
        this.list.push(component)
    },
    unregister(id) {
        this.list = this.list.filter(item => item.id != id)
    },
    component(id) {
        return this.list.find(item => item.id == id)
    },
    allComponents() {
        return this.list
    },
    open(id){
        this.component(id).open();
    },
    close(id){
        this.component(id).close();
    },
    toggle(id){
        this.component(id).toggle();
    },
    getState(id){
        return this.component(id).state;
    },
};



