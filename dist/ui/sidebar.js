import { stateTrait } from '../traits/stateTrait'

window.$stm.sideBar = (id, config) => {
    return {
        id: id,
        type:'sidebar',
        state: config.state,
        ...stateTrait,
        breakpoint: config.breakpoint,
        init(){
            $stm.register(this);
            this.checkSize();
        },
        checkSize()
        {
            if(window.innerWidth < this.breakpoint.width){
                this.state = false;
            }else{
                this.state = true;
            }
        },
        clickOutsideFn(){
            if(this.breakpoint.clickOutside){
                if(window.innerWidth < this.breakpoint.width) this.close()
            }        
        }
    }
}