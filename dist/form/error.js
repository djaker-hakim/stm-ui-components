import { stmInitTrait } from "../traits/stmInitTrait"; 

window.$stm.error = (id, message) =>
{
    return {
        ...stmInitTrait,
        id: id,
        type: 'error',
        message: message,
        init(){
            this.stmInit();
        },
        setMessage(message){
            this.message = message;
        },
        reset(){
            this.message = '';
        }
    }
}