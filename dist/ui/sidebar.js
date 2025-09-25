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
            window.addEventListener('open-sidebar', (e) => this.open(e.detail.id));
            window.addEventListener('close-sidebar', (e) => this.close(e.detail.id));
            window.addEventListener('toggle-sidebar', (e) => this.toggle(e.detail.id));
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