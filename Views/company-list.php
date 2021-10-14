<?php
    require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Company List</h2>
               <table class="table bg-light-alpha">
                    <thead>
                         <th>Name</th>
                         <th>Year of Foundation</th>
                         <th>City</th>
                         <th>Description</th>
                         <th>Logo</th>
                         <th>Email</th>
                         <th>Phone Number</th>
                    </thead>
                    <tbody>
                         <?php
                              foreach($companyList as $company)
                              {
                                   ?>
                                        <tr>
                                             <td><?php echo $company->getName() ?></td>
                                             <td><?php echo $company->getYearFoundation() ?></td>
                                             <td><?php echo $company->getCity() ?></td>
                                             <td><?php echo $company->getDescription() ?></td>
                                             <td><?php echo $company->getLogo() ?></td>
                                             <td><?php echo $company->getEmail() ?></td>
                                             <td><?php echo $company->getPhoneNumber() ?></td>
                                        </tr>
                                   <?php
                              }
                         ?>
                         </tr>
                    </tbody>
               </table>
          </div>
     </section>
</main>