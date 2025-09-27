import { stateTrait } from '../traits/stateTrait'
import { stmInitTrait } from "../traits/stmInitTrait"; 

window.$stm.sideBar = (id, config) => {
    return {
        ...stmInitTrait,
        id: id,
        type:'sidebar',
        state: config.state,
        ...stateTrait,
        breakpoint: config.breakpoint,
        init(){
            this.stmInit();
            window.addEventListener('open-sidebar', (e) => this.open(e.detail));
            window.addEventListener('close-sidebar', (e) => this.close(e.detail));
            window.addEventListener('toggle-sidebar', (e) => this.toggle(e.detail));
            this.checkSize();
            window.addEventListener('resize', (e) => this.checkSize());

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