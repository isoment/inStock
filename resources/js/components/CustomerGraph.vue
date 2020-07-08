<template>
    <div>
        <canvas ref="customerGraph"></canvas>
    </div>
</template>

<script>
export default {

    props: ['keys', 'values'],

    mounted() {
        var context = this.$refs.customerGraph.getContext('2d');
        var customerGraph = new Chart(context, {
            type: 'doughnut',
            data: {
                labels: this.keys,
                datasets: [
                    {
                        label: "TEST",
                        backgroundColor: ["#6574cd", "#f66d9b", "#38c172", "#9561e2", "#4dc0b5"],
                        data: this.values,
                    }
                ]
            }
        });
    }

}
</script>