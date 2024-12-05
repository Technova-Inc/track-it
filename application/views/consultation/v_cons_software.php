<div class="d-flex vh-100">
        <div class="container content-center">
            <div class="row content-center">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="mb-0">Applications</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Éditeur</th>
                                        <th scope="col">Nom</th>
                                        <th scope="col">Version</th>
                                        <th scope="col">Commentaire</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($software as $MySoftware): ?>
                                        <tr>
                                            <td class="text-start"><?php echo $MySoftware['PUBLISHER']?></td>
                                            <td class="text-start"><?php echo $MySoftware['NAME']?></td>
                                            <td class="text-start"><?php echo $MySoftware['VERSION']?></td>
                                            <td class="text-start"><?php echo $MySoftware['COMMENTS']?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- Pagination -->
                        <!-- Pagination -->
                        <nav aria-label="Page navigation example" class="pagination-container">
                            <ul class="pagination justify-content-end pagination-sm">
                                <li class="page-item">
                                    <a class="page-link" href="#">Précédent</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">1</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">2</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">3</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">Suivant</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>