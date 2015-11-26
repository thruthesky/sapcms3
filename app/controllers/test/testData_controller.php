<?php
class TestData_controller extends MY_Controller
{
    public function index() {

       for( $i = 0; $i<111; $i++) {
            user()->create()
                ->set('username', "Username2-$i")
                ->setPassword("Username2-$i")
                ->set('email',  "user2-$i@gmail.com")
                ->set('address', "Block $i, Balibago, Angeles City, Pampanga")
                ->set('first_name', "First $i")
                ->set('last_name', "Last $i")
                ->save();
        }

        for( $i = 0; $i<111; $i++) {
            user()->create()
                ->set('username', "Yourname$i")
                ->setPassword("Yourname$i")
                ->set('email',  "name$i@gmail.com")
                ->set('address', "Block $i, Quezone City")
                ->set('first_name', "FName $i")
                ->set('last_name', "Lname $i")
                ->save();
        }
		
		user()->create()
                ->set('username', "iamuser1")
                ->setPassword("iamuser1")
                ->set('email',  "iamuser1@gmail.com")
                ->set('address', "Where iamuser1 Lives")
                ->set('first_name', "FName iamuser1")
                ->set('last_name', "Lname iamuser1")
                ->save();
				
		user()->create()
                ->set('username', "someonelikeme")
                ->setPassword("someonelikeme")
                ->set('email',  "someonelikeme@gmail.com")
                ->set('address', "Where someonelikeme Lives")
                ->set('first_name', "FName someonelikeme")
                ->set('last_name', "Lname someonelikeme")
                ->save();
		
		for( $i = 0; $i<111; $i++) {
			$user1 = user()->loadByUsername('iamuser1');
			$user2 = user()->loadByUsername('someonelikeme');
			
			$id1 = $user1->get('id');
			$id2 = $user2->get('id');
		
			if( $i % 2 == 0 ) {
				$idx_from = $id1;
				$idx_to = $id2;
			}
			else{
				$idx_from = $id2;
				$idx_to = $id1;
			}
		
            message()->create()
                ->set('id_from', $idx_from)
                ->set('id_to',  $idx_to)
                ->set('title', "Title $i")
                ->set('content', "$i.) For some, the day after Thanksgiving is the be-all and end-all of holiday shopping. Black Friday is renowned for its sales on new-to-market items, electronics and appliances, so use this day to capitalize on these items. This year, wearables, such as FitBit, Apple Watch, and Ringly, will be making an appearance on many wish lists.")
                ->save();
        }
	
        echo "Done!";
    }
}