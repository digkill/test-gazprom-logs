Ext.onReady(function () {



    Ext.define('Log', {
        extend: 'Ext.data.Model',
        fields: [
            {name: 'id', type: 'integer'},
            {name: 'date', type: 'string'},
            {name: 'time', type: 'string'},
            {name: 'ip', type: 'string'},
            {name: 'urlFrom', type: 'string'},
            {name: 'urlTo', type: 'string'},
            {name: 'browser', type: 'string'},
            {name: 'os', type: 'string'}
        ]
    });

    var transformData = {
        "id": "dd",
        "date": "dd",
    };


    var store = Ext.create('Ext.data.Store', {
        model: 'Log',
        autoLoad: true,
        pageSize: 10,
        proxy: {
            type: 'ajax',
            url: '/api/log/get',
            reader: {
                type: 'json',
                rootProperty: 'result.content',
                totalProperty: 'result.total'
            }
        }
    });

    console.log(
        store.model.getFields()
    );
/*
    for (var key  in store.getData()) {

        console.log(store);
        console.log(store[key]);
    }*/

    var dataColumns = [
            {
                xtype: 'rownumberer'
            },
            {text: 'ID', dataIndex: 'id', flex: 1},

            {text: 'Дата', dataIndex: 'date', flex: 1},
            {text: 'Время', dataIndex: 'time', flex: 1},

            {
                xtype: 'gridcolumn',
                text: 'Подробная информация',
                columns: [
                    {
                        text: 'Откуда перешел', dataIndex: 'urlFrom', flex: 1
                    }
                ]
            },
            {text: 'Откуда перешел', dataIndex: 'urlFrom', flex: 1},
            {text: 'Куда перешел', dataIndex: 'urlTo', flex: 1},
            {text: 'Браузер', dataIndex: 'browser', flex: 1},
            {text: 'ОС', dataIndex: 'os', flex: 1}
        ];


    Ext.create('Ext.grid.Panel', {
        plugins: [{
            ptype: 'gridfilters'
        }],
        title: 'Logs',
        store: {
          fields: Log,
            data: transformData
        },
        dockedItems: [{
            xtype: 'pagingtoolbar',
            store: store,
            dock: 'bottom',
            displayInfo: true,
            beforePageText: 'Страница',
            afterPageText: 'из {0}',
            displayMsg: 'Пользователи {0} - {1} из {2}'
        }],
        columns: dataColumns,
        xtype: 'actioncolumn',

        height: 400,
        width: 1000,
        renderTo: Ext.getElementById('js-grid-log-data')
    });

});


/*
Ext.define('GazProm.view.MyGridPanel', {
    extend: 'Ext.grid.Panel',

    requires: [
        'Ext.grid.column.Number',
        'Ext.grid.View'
    ],

    height: 250,
    width: 600,
    title: 'Лог действий пользователя',

});


Ext.define('Log', {
    extend: 'Ext.data.Model',
    fields: [
        {name: 'id', type: 'integer'},
        {name: 'date', type: 'string'},
        {name: 'time', type: 'string'},
        {name: 'ip', type: 'string'},
        {name: 'urlFrom', type: 'string'},
        {name: 'urlTo', type: 'string'},
        {name: 'browser', type: 'string'},
        {name: 'os', type: 'string'}
    ]
});
*/
/*
var store = Ext.create('Ext.data.Store', {
    model: 'Log',
    autoLoad: true,
    pageSize: 10,
    proxy: {
        type: 'ajax',
        url: '/api/log/get',
        reader: {
            type: 'json',
            rootProperty: 'result.content',
            totalProperty: 'result.total'
        }
    }
});
*/
/*
Ext.define('GazProm.store.MyStore', {
    extend: 'Ext.data.Store',
    model: 'Log',
    autoLoad: true,
    pageSize: 10,
    requires: [
        'Ext.data.Field'
    ],
    storeId: 'MyStore',
    proxy: {
        type: 'ajax',
        url: '/api/log/get',
        reader: {
            type: 'json',
            rootProperty: 'result.content',
            totalProperty: 'result.total'
        }
    }

});
*/
/*

 [{
 "firstName": "Foo",
 "lastName": "Bar",
 "balances": {
 Natwest: 9,
 BankofScotland: 2,
 Lloyds: 40,
 Halifax: 89,
 Lords: 12
 },
 }]

 fields: [{
 name: 'firstName'
 }, {
 name: 'lastName'
 }, {
 name: 'balances'
 }],
 */

/*
Ext.application({
    name: 'GazProm',

    launch: function () {

        var originalStore = Ext.create('GazProm.store.MyStore');


        // TODO: Probably not the best way?
        var d = originalStore.load().getAll();

        // Columns in the grid
        var bankAcountsColumns = [];

        // Fields in the store
        var fields = ['id', 'date']

        // Data for the new store with remmaped model
        var transformData = {
            "id": d.id,
            "date": d.date,
        }

        console.log(d);

        for (var key in d.info) {
            bankAcountsColumns.push({
                xtype: 'gridcolumn',
                dataIndex: key,
                text: key
            });
            console.log(key);

            transformData[key] = d.info[key];

            //  console.log(transformData);

            fields.push(key);
        }

        var myCustomColumns = [
            {
                xtype: 'rownumberer'
            },
            {text: 'ID', dataIndex: 'id', flex: 1},

            {text: 'Дата', dataIndex: 'date', flex: 1},
            {text: 'Время', dataIndex: 'time', flex: 1},
            {
                text: 'IP адрес пользователя', dataIndex: 'info', flex: 1, filter: {type: 'string'}
            },
            {text: 'Откуда перешел', dataIndex: 'urlFrom', flex: 1},
            {text: 'Куда перешел', dataIndex: 'urlTo', flex: 1},
            {text: 'Браузер', dataIndex: 'browser', flex: 1},
            {text: 'ОС', dataIndex: 'os', flex: 1},
            {
                xtype: 'gridcolumn',
                text: 'Info',
                columns: bankAcountsColumns
            }
        ]

        Ext.create('GazProm.view.MyGridPanel', {
            renderTo: Ext.getElementById('js-grid-log-data'),
            columns: myCustomColumns,
            store: {
                fields: fields,
                data: transformData
            }
        });
    }
});

*/
/*
 Ext.onReady(function () {



 Ext.define('Log', {
 extend: 'Ext.data.Model',
 fields: [
 {name: 'id', type: 'integer'},
 {name: 'date', type: 'string'},
 {name: 'time', type: 'string'},
 {name: 'ip', type: 'string'},
 {name: 'urlFrom', type: 'string'},
 {name: 'urlTo', type: 'string'},
 {name: 'browser', type: 'string'},
 {name: 'os', type: 'string'}
 ]
 });

 var store = Ext.create('Ext.data.Store', {
 model: 'Log',
 autoLoad: true,
 pageSize: 10,
 proxy: {
 type: 'ajax',
 url: '/api/log/get',
 reader: {
 type: 'json',
 rootProperty: 'result.content',
 totalProperty: 'result.total'
 }
 }
 });


 Ext.create('Ext.grid.Panel', {
 plugins: [{
 ptype: 'gridfilters'
 }],
 title: 'Logs',
 store: store,
 dockedItems: [{
 xtype: 'pagingtoolbar',
 store: store,
 dock: 'bottom',
 displayInfo: true,
 beforePageText: 'Страница',
 afterPageText: 'из {0}',
 displayMsg: 'Пользователи {0} - {1} из {2}'
 }],
 columns: [
 {
 xtype: 'rownumberer'
 },
 {text: 'ID', dataIndex: 'id', flex: 1},

 {text: 'Дата', dataIndex: 'date', flex: 1},
 {text: 'Время', dataIndex: 'time', flex: 1},
 {
 text: 'IP адрес пользователя', dataIndex: 'info', flex: 1, filter: {type: 'string'}
 },
 {text: 'Откуда перешел', dataIndex: 'urlFrom', flex: 1},
 {text: 'Куда перешел', dataIndex: 'urlTo', flex: 1},
 {text: 'Браузер', dataIndex: 'browser', flex: 1},
 {text: 'ОС', dataIndex: 'os', flex: 1}
 ],
 xtype: 'actioncolumn',

 height: 400,
 width: 1000,
 renderTo: Ext.getElementById('js-grid-log-data')
 });

 });
 */