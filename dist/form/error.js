window.$stm.error = (id, message) =>
{
    return {
        id: id,
        message: message,
        init(){
            $stm.register(this);
        },
        setMessage(message){
            this.message = message;
        },
        reset(){
            this.message = '';
        }
    }
}