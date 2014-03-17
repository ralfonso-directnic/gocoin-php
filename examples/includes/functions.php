<?php

#######  #     #  #     #   #####   #######  ###  #######  #     #   #####   
#        #     #  ##    #  #     #     #      #   #     #  ##    #  #     #  
#        #     #  # #   #  #           #      #   #     #  # #   #  #        
#####    #     #  #  #  #  #           #      #   #     #  #  #  #   #####   
#        #     #  #   # #  #           #      #   #     #  #   # #        #  
#        #     #  #    ##  #     #     #      #   #     #  #    ##  #     #  
#         #####   #     #   #####      #     ###  #######  #     #   #####   

function showObject($obj,$recurse=TRUE)
{
  if (!empty($obj) && is_object($obj) && get_class($obj) == 'stdClass')
  {
    echo '<ul>' . "\n";
    foreach (get_object_vars($obj) as $key => $value)
    {
      if (is_object($value) && get_class($value) == 'stdClass')
      {
        if ($recurse)
        {
          echo "  <li><b>$key:</b><br/>\n";
          foreach ($value as $subkey => $subobj)
          {
            echo "<div><b>$subkey:</b></div>\n";
            showObject($subobj);
          }
          echo "  </li>\n";
        }
        else
        {
          echo "  <li><b>$key:</b> " . sizeof($value) . " OBJECTS NOT SHOWN</li>\n";
        }
      }
      else if (is_array($value))
      {
        if ($recurse)
        {
          echo "  <li><b>$key:</b><br/>\n";
          foreach ($value as $subkey => $subobj)
          {
            echo "<div><b>$subkey:</b></div>\n";
            showObject($subobj);
          }
          echo "  </li>\n";
        }
        else
        {
          echo "  <li><b>$key:</b> " . sizeof($value) . " OBJECTS NOT SHOWN</li>\n";
        }
      }
      else
      {
        echo "  <li><b>$key:</b> " . $value . "</li>\n";
      }
    }
    echo '</ul>' . "\n";
  }
}
