window.$stm.table = (id, data, config) => {
    return {
        id: id,
        type: 'table',
        rows: [],
        selection: [],
        loading: false,
        selectable: false,
        selectAllBtn: null,
        sortable: true,
        sortProps: {},
        cardHeader: [],
        headers: {},
        allHeaders: {},
        init(){
            this.selectable = config.selectable;
            this.selectAllBtn = config.selectAllBtn;
            this.sortable = config.sortable;
            this.setupData(data);
            $stm.register(this);
        },
        setupData(rows){
            this.setDefaultHeaders(rows);
            this.setHeaders(config.table.headers);
            this.setCardHeader(config.table.headers);
            this.setData(rows);
        },
        setData(rows){
            this.sortProps.unsortedRows = rows.slice();
            this.rows = rows.slice();
        },
        setDefaultHeaders(rows){
            // set up all headers
            if(rows.length > 0){
                Object.keys(rows[0]).map(key => this.allHeaders[key] = key);
                return;
            }
            this.allHeaders = {};                   
        },
        setHeaders(headers){
            // set custom headers
            if(Object.keys(headers).length > 0){
                this.headers = headers ;
                return
            }
            // set default headers
            this.headers = this.allHeaders;
        },
        setCardHeader(header){
            this.cardHeader = [];
            let obj = this.headers;
            if(Object.keys(header).length > 0){
                obj = header;
                this.cardHeader.push(Object.keys(obj)[0], Object.values(obj)[0]);
                return
            }
            obj = this.headers;
            this.cardHeader.push(Object.keys(obj)[0], Object.values(obj)[0]);
        },
        removeSelect(){
            this.selectable = false;
            this.selection = [];
        },
        showSelect(){
            this.selectable = true;
            this.selection = [];
        },
        toggleSelect(){
            this.selectable = !this.selectable;
            this.selection = [];
        },
        select(row){
            this.selection.includes(row) ? this.selection = this.selection.filter(r => r !== row) : this.selection.push(row);
        },
        selectAll(){
            this.selection = this.selection.length === this.rows.length ? [] : this.rows;
        },
        getId(){
            return this.id;
        },
        getSelection(){
            return this.selection;
        },
        sortBy(key){
            if(!this.sortable || !this.rows.length > 0) return;
            if(this.sortProps.key == key){
                this.sortProps.order = this.sortProps.order === 'asc' ? 'desc' : 'unsort';
                this.sortProps.order === 'unsort' ? this.sortProps.key = '' : '';
                this.sortRows(key, this.sortProps.order);
                return;
            } 
            this.sortProps.order = 'asc',
            this.sortProps.key = key;
            this.sortRows(key, this.sortProps.order);
        },
        sortRows(key, order){
            if(order == 'unsort'){
                this.rows = this.sortProps.unsortedRows.slice();
                return;
            }
            this.rows = this.rows.sort((a, b) => {
                    if(order === 'asc'){   
                        if(a[key] === b[key]) return 0;
                        return a[key] < b[key] ? -1 : 1;
                    }else if(order === 'desc'){
                        if(a[key] === b[key]) return 0;
                        return a[key] > b[key] ? -1 : 1;
                    }
                }
            );
        }
    }
}