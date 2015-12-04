<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Entity_controller extends MY_Controller
{

    public function collectionEntity() {
        $tables = $this->db->list_tables();
        $entities = [];
        foreach ($tables as $table)
        {
            if ( strpos($table, '_meta_entity')  ) {
                $name = str_replace('_meta_entity', '', $table);
                $entities[] = $name;
                //$entityList[$name] = "Meta Entity : <a href='/entity/$name/list'>$name</a>";
            }
            else if ( strpos($table, '_node_entity')  ) {
                $name = str_replace('_node_entity', '', $table);
                $entities[] = $name;
                //$entityList[$name] = "Node Entity : <a href='/entity/$name/list'>$name</a>";
            }
            else continue;

            /*
            $fields = $this->db->list_fields($table);
            $numrows = $name()->countAll();
            echo " ( $numrows )";
            echo '<hr>';
            */
        }
        $this->render([
            'page' => 'entity.entities',
            'theme' => 'admin',
            'entities' => $entities,
			'collapsedTab' => 'entity',
			'name' => 'all',
        ]);
    }
    public function collection($name, $offset=0)
    {
		//commented out because this is not needed if we use dataTables
		$list = [];
		$total_rows = 0;
        /*
		$entity = $name();
        //$per_page = 10; //not compatible with almsaeedstudio
		
        $list = $entity->search([
            'order_by' => 'id DESC',
            'offset' => $offset,
            //'limit' =>  $per_page,//not compatible with almsaeedstudio
        ]);
        $total_rows = $entity->searchCount();
		*/		
		
        $this->render([
            'page'=>'entity.list',
            'theme' => 'admin',
            'name' => $name,
            'list' => $list,
            //'per_page' =>  $per_page, //not compatible with almsaeedstudio
            'total_rows' => $total_rows,
			'collapsedTab' => 'entity',
        ]);
    }


    public function edit($name, $id) {		
        $entity = $name()->load($id);

        $table = $entity->getTable();
        $query = $this->db->query("SELECT * FROM $table WHERE 1 LIMIT 1");
        $rows =  $query->result_array();
        //$row = $rows[0];
		
        $fields = $query->field_data();
		
		 $this->render([
            'page'=>'entity.edit',
            'theme' => 'admin',
			//'id' => $id,
			'entity' => $entity,
            'fields' => $fields,
			'name' => $name,			
			'collapsedTab' => 'entity',
        ]);
		/*
        echo "<form>";
        echo "<table>";
        foreach ($fields as $field)
        {
            $name = $field->name;
            $value = $row[$name];
            echo "<tr>";
            echo "<td>" . $name . "</td>";
            if ( $field->name == 'id' ) {
                echo "<td>$value</td>";
            }
            else {
                echo "<td><input type='text' name='$name' value='$value'></td>";
            }
            echo "</tr>";
        }
        echo "</table>";

        echo "<input type='submit'>";

        echo "</form>";
		*/
    }
}
