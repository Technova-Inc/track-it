<div class="row content-center mt-5">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="mb-0">Réseaux</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Adresse IP</th>
                                        <th scope="col">Masque</th>
                                        <th scope="col">Vitesse</th>
                                        <th scope="col">Adresse MAC</th>
                                        <th scope="col">MTU</th>
                                        <th scope="col">Etat</th>
                                        <th scope="col">Passerelle</th>
                                        <th scope="col">IP DHCP</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($network as $Mynetwork): ?>
                                    <tr>
                                        <td class="text-start"><?php echo $Mynetwork['IPADDRESS']?></td>
                                        <td class="text-start"><?php echo $Mynetwork['IPMASK']?></td>
                                        <td class="text-start"><?php echo $Mynetwork['SPEED']?></td>
                                        <td class="text-start"><?php echo $Mynetwork['MACADDR']?></td>
                                        <td class="text-start"><?php echo $Mynetwork['MTU']?></td>
                                        <td class="text-start"><?php echo $Mynetwork['STATUS']?></td>
                                        <td class="text-start"><?php echo $Mynetwork['IPGATEWAY']?></td>
                                        <td class="text-start"><?php echo $Mynetwork['IPDHCP']?></td>
                                        <td class="text-start"><?php echo $Mynetwork['TYPEMIB']?></td>
                                        <td class="text-start"><?php echo $Mynetwork['DESCRIPTION']?></td>
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
        </div>
    </div>