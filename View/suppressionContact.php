<td><?php echo $contact['nom']; ?></td>
                        <td><?php echo $contact['prenom']; ?></td>
                        <td><?php echo $contact['numeroTel']; ?></td>
                        <td><?php echo $contact['favori']; ?></td>
<td><button type="submit" name="voir_details"><a href="detail_contact.php?contact_id=<?php echo $contact['id_contacts']; ?>">Voir détails</a></button></td>



                <?php foreach ($contacts as $contact) : ?>
                <?php endforeach; ?>

