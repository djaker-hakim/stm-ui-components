<script>
    function dataTableFn(id, data, config){
        return {
            id: id,
            type:'datatable',
            data: null,
            allRows: [],
            rows: [],
            table: {allHeaders: {}, headers: {}},
            navigation: {
                columns: {},
                orderedColumns: {},
                search: '',
            },
            pagination: null,
            pageControl: {
                perPage: 5,
                pages: 0,
                currentPage: 1,
                start: 0,
                end: 0,
                dataLength: 0,
                paginate: true,
            },
            init(){
                this.$nextTick(() => {
                    this.setData(data);
                    this.setConfig(config);
                    this.setColumns();
                    this.setFinalData();
                    $stm.register(this);
                });
            },
            setConfig(config){
                this.table = $stm.component(config.tableId);
                this.pageControl.paginate = !(config.pagination == 'none')
                this.pagination = this.pageControl.paginate ? $stm.component(config.paginationId) : null;
                this.pageControl.perPage = Number(Object.keys(config.navigation.perPageOptions)[0]);
            },                
            toggleHeaders(key){
                headers = new Map(Object.entries(this.headers));
                headers.has(key) ? this.removeHeader(key) : this.addHeader(key);
            },
            addHeader(key){
                let headers = {};
                let keys = Object.keys(this.navigation.orderedColumns);
                keys.forEach((itemKey) => {
                    if(itemKey == key || Object.keys(this.headers).includes(itemKey)){
                        headers[itemKey] = this.navigation.orderedColumns[itemKey];
                    }
                })
                this.table.setHeaders(headers);
                this.headers = this.table.headers;               
            },
            removeHeader(key){
                headers = new Map(Object.entries(this.headers));
                headers.delete(key);
                this.table.setHeaders(Object.fromEntries(headers.entries()));
                this.headers = this.table.headers;                 
            },
            setColumns(){
                let headers = {};
                this.table.setupData(this.data);
                Object.keys(this.table.allHeaders).forEach((key) => {
                    Object.keys(this.table.headers).includes(key) ?
                    headers[key] = this.table.headers[key] :
                    headers[key] = this.table.allHeaders[key];
                });
                this.headers = this.table.headers;
                this.navigation.columns = headers;
                this.navigation.orderedColumns = headers;
            },
            changeOrder(item, position){
                let columns = {};
                let order = Object.keys(this.navigation.orderedColumns);
                order.splice(order.indexOf(item), 1);
                order.splice(position, 0, item);                  
                order.forEach((key) => {
                    columns[key] = this.navigation.columns[key];
                });
                this.navigation.orderedColumns = columns;
                this.applyOrder();   
            },
            applyOrder(){
                let headers = {};
                let keys = Object.keys(this.navigation.orderedColumns);
                keys.forEach((key) => {
                    if(Object.keys(this.headers).includes(key)){
                        headers[key] = this.navigation.orderedColumns[key];
                    }
                });
                this.table.setHeaders(headers);
                this.headers = this.table.headers;  
            },

            searchBy(text, filters){
                if(text == '') return this.allRows;
                let rows = this.allRows.filter((row) => {
                    let status = false;
                    for (key in filters) {
                        status ||= row[key].toString().toLowerCase().indexOf(text.trim().toLowerCase()) != -1;
                    }
                    return status;
                }); 
                this.allRows = rows;
                return rows;
            },
            setData(rows){
                this.data = rows;
            },
            paginate(page){
                const control = this.pageControl;
                control.currentPage = Number(page);               
                control.start = ( control.perPage * ( control.currentPage - 1))
                control.end = Math.min((control.perPage *  control.currentPage ) - 1, control.dataLength)
                let rows = this.allRows.slice(control.start, control.end+1);         
                this.rows = rows;
                this.table.setData(rows);
                return rows;
            },
            setPagination(){
                const control = this.pageControl;
                control.dataLength = this.allRows.length;
                control.pages = Math.ceil(control.dataLength / control.perPage);
                this.pagination.setTotalPages(control.pages);
                this.pagination.currentPage = 1;
                this.paginate(1);
            },
            setFinalData(){
                this.allRows = this.data;
                this.searchBy(this.navigation.search, this.table.headers);
                if(this.pageControl.paginate){
                    this.setPagination();                 
                }else{
                    this.table.setData(this.allRows);
                }
            },
            setSearch(text){
                this.navigation.search = text;
                this.setFinalData();
            },
            setPerPage(number){
                number = Number(number)
                this.pageControl.perPage = isNaN(number) ? 10 : number ;
                this.setFinalData();
            },
        }
    }
</script>