<template>
    <div>
        <canvas ref="graph"></canvas>
    </div>
</template>

<script>
export default {

    props: ['keys', 'values'],

    mounted() {
        var context = this.$refs.graph.getContext('2d');
        var revenueGraph = new Chart(context, {
            type: 'pie',
            data: {
                labels: this.keys,
                datasets: [
                    {
                        label: "Revenue",
                        backgroundColor: ["#3490dc", "#6cb2eb","#ffed4a","#6574cd","#38c172","#9561e2","#4dc0b5"],
                        data: this.values,
                    }
                ]
            }
        });
    }

}
</script>
