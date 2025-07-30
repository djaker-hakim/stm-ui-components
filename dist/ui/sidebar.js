window.$stm.sideBar = (id, config) => {
    return {
        id: id,
        type:'sidebar',
        state: config.state,
        breakpoint: config.breakpoint,
        init(){
            $stm.register(this);
            this.checkSize();
        },
        open(id='')
        {
            if(id){
                (this.id == id) ? this.state = true : '';
            }else{
                this.state = true;
            }  
        },
        close(id='')
        {
            if(id){
                (this.id == id) ? this.state = false : '';
            }else{
                this.state = false;
            }
        },
        toggle(id='')
        {
            if(id){
                (this.id == id) ? this.state = !this.state : '';
            }else{
                this.state = !this.state;
            }
        },
        checkSize()
        {
            if(window.innerWidth < this.breakpoint.width){
                this.state = false;
            }else{
                this.state = true;
            }
        },
        getState()
        {
            return this.state;
        },
        getId()
        {
            return this.id;
        },
    }
}