import { stmInitTrait } from "../traits/stmInitTrait"; 

window.$stm.password = (id, config) =>
{
    return {
        ...stmInitTrait,
        id: id,
        type: 'password',
        state: config.state,
        showButton: config.showButton,
        init(){
            this.stmInit();
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