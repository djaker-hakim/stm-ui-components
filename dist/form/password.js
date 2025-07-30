window.$stm.password = (id, config) =>
{
    return {
        id: id,
        type: 'password',
        state: config.state,
        showButton: config.showButton,
        init(){
            $stm.register(this);
        },
        show(){
            this.state = true;
        },
        hide(){
            this.state = false;
        },
        toggle(){
            this.state = !this.state;
        }
    }
}