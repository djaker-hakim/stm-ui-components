window.$stm.select = (id, options, selected = '') =>
{
    return {
        id: id,
        type: 'select',
        options: [],
        selected: '',
        init() {
            $stm.register(this)
            this.options = options;
            selected ? this.selected = selected : '';
        },
        getSelection(){
            return this.$root.value; 
        }
    }
}