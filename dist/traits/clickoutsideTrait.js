export const clickOutsideTrait = {

    clickOutsideFn(){
        if(this.clickOutside) this.close();
    }
    
}