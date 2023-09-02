<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script>
            $(document).ready(function() {
            $('#myTable').DataTable({
                "paging": true, // activer la pagination
                "lengthChange": true, // masquer le nombre d'éléments affichés par page
                "searching": true, // masquer la fonction de recherche
                "ordering": true, // activer le tri des colonnes
                "info": true, // afficher les informations de pagination
                "autoWidth": true, // désactiver la largeur automatique des colonnes
                "language": {
                    "emptyTable": "Aucune donnée disponible", // message lorsque la table est vide
                    "info": "Affichage de _START_ à _END_ sur _TOTAL_ éléments", // message d'information de pagination
                    "infoEmpty": "Affichage de 0 à 0 sur 0 élément", // message d'information lorsque la table est vide
                    "infoFiltered": "(filtré à partir de _MAX_ éléments au total)", // message d'information sur le filtrage
                    "lengthMenu": "Afficher _MENU_ éléments par page", // menu déroulant pour changer le nombre d'éléments affichés par page
                    "search": "Rechercher :", // texte du champ de recherche
                    "zeroRecords": "Aucun enregistrement correspondant trouvé" // message lorsque la recherche ne trouve aucun enregistrement
                }
            });
        });
    </script>