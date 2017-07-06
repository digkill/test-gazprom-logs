Ext.onReady(function () {

    Ext.define('User', {
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
        model: 'User',
        autoLoad: true,
        pageSize: 10,
        proxy: {
            type: 'ajax',
            url: '/api/log/get',
            reader: {
                type: 'json',
                root: 'result.content',
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
                text: 'IP адрес пользователя', dataIndex: 'ip', flex: 1, filter: {type: 'string'}
            },
            {text: 'Откуда перешел', dataIndex: 'urlFrom', flex: 1},
            {text: 'Куда перешел', dataIndex: 'urlTo', flex: 1},
            {text: 'Браузер', dataIndex: 'browser', flex: 1},
            {text: 'ОС', dataIndex: 'os', flex: 1},
        ],
        xtype: 'actioncolumn',

        height: 400,
        width: 1000,
        renderTo: Ext.getElementById('js-grid-log-data')
    });

});
