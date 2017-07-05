Ext.onReady(function () {

    Ext.define('User', {
        extend: 'Ext.data.Model',
        fields: [ 'name', 'email', 'phone' ]
    });



    var userStore = Ext.create('Ext.data.Store', {
        model: 'User',
        data: [
            { name: 'Lisa', email: 'lisa@simpsons.com', phone: '555-111-1224' },
            { name: 'Bart', email: 'bart@simpsons.com', phone: '555-222-1234' },
            { name: 'Homer', email: 'homer@simpsons.com', phone: '555-222-1244' },
            { name: 'Marge', email: 'marge@simpsons.com', phone: '555-222-1254' }
        ]
    });

    Ext.create('Ext.grid.Panel', {
        title: 'Logs',
        store: userStore,
        columns: [
            { text: 'Name', dataIndex: 'name' },
            { text: 'Email', dataIndex: 'email', flex: 1 },
            { text: 'Phone', dataIndex: 'phone' }
        ],
        height: 800,
        width: 600,
        renderTo: Ext.getElementById('js-grid-log-data')
    });

});
