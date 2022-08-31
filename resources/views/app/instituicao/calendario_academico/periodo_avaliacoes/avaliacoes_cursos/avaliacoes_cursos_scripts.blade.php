<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.0/jquery.js"></script>

<script type="text/javascript">
    // Select Turmas
    $(document).ready(function() {
        $('select[name="curso_id"]').on('change', function() {
            var curso_id = $(this).val()
            if (curso_id) {
                $.ajax({
                    url: "{{ url('/calendario-academico/periodo-avaliacoes/avaliacoes-cursos/ajax') }}/" + curso_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        var d = $('select[name="turma_id"]').empty()
                        $.each(data, function(key, value) {
                            $('select[name="turma_id"]').append(
                                '<option value="' + value.id + '">' + value
                                .codigo_turma + '</option>')
                        })
                    },
                })
            } else {
                alert('Error!')
            }
        })
    })

    // Select Disciplinas
    $(document).ready(function() {
        $('select[name="curso_id"]').on('change', function() {
            var curso_id = $(this).val()
            if (curso_id) {
                $.ajax({
                    url: "{{ url('/calendario-academico/periodo-avaliacoes/avaliacoes-cursos/disciplinas/ajax') }}/" + curso_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        // console.log(data)
                        var d = $('select[name="disciplina_id"]').empty()
                        $.each(data, function(key, value) {
                            console.log(value.disciplina_id)
                            $('select[name="disciplina_id"]').append('<option value="' + value.disciplina_id + '">' + value.disciplina.disciplina + '</option>')
                        })
                    },
                })
            } else {
                alert('Error!')
            }
        })
    })
</script>
