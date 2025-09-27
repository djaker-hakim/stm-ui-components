import { stmInitTrait } from "../traits/stmInitTrait"; 

window.$stm.select = (id, options, selected = '') =>
{
    return {
        ...stmInitTrait,
        id: id,
        type: 'select',
        options: [],
        selected: '',
        init() {
            this.stmInit();
            this.options = options;
            selected ? this.selected = selected : '';
        },
        getSelection(){
            return this.$root.value; 
        }
    }
}