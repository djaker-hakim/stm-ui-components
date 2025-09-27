
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
    ref(ref){
        if(ref == "") return;
        return this.list.find(item => item.ref == ref)
    },
    get(idOrRef){
        if(this.component(idOrRef)) return this.component(idOrRef);
        if(this.ref(idOrRef)) return this.ref(idOrRef);
        return undefined;
    },
    allComponents() {
        return this.list
    },
    open(id){
        this.get(id).open();
    },
    close(id){
        this.get(id).close();
    },
    toggle(id){
        this.get(id).toggle();
    },
    getState(id){
        return this.get(id).state;
    },
    resetAllErrors(){
        const errors = this.list.filter(item => item.type == 'error');
        errors.forEach(error => error.reset());
    }
};



