const app = new Vue({
    el: "#app",
    data:{
        currencies: {},
        cur1: 0, cur2: 0,
        money: 1, exchange: 1,
    },
    watch: {
        cur1 () {
            this.exchange = (this.cur1.value / this.cur2.value).toFixed(3);
            this.money = 1;
        },
        cur2 () {
            this.exchange = (this.cur1.value / this.cur2.value).toFixed(3);
            this.money = 1;
        },
        money () {
            this.exchange = (this.money * (this.cur1.value / this.cur2.value)).toFixed(3);
        },
        exchange () {
            this.money = (this.exchange / (this.cur1.value / this.cur2.value)).toFixed(3);
        }
    },
    mounted(){
        $.get('api/control/Currency/all.php', (data) => {
            this.currencies = JSON.parse(data).data;
            this.cur1 = this.currencies[0];
            this.cur2 = this.currencies[0];
        });
    }
})

$('#option-login').click( () => {
    $('#login').show();
    $('#register').hide();
})

$('#option-register').click(() => {
    $('#login').hide();
    $('#register').show();
})