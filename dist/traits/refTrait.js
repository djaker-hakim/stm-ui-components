export const refTrait = {
    ref: null,
    setRef(){
        const root = this.$root;
        let el = null;
        if(root.hasAttribute('stm-ref')){
            this.ref = root.getAttribute('stm-ref');
        } else if (el = root.querySelector('[stm-ref]')){
            this.ref = el.getAttribute('stm-ref')
        }
    },
}