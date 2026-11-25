<?php 

class RegistroTexto{

    /**
     * PROPIEDADES-->Dos propiedades privadas 
     */
    private string $_cadena;
    private DateTime $_fechaHora;


    /**
     * METODO MAGICO __CONSTRUCT -->
     *
     * @param string $cadena
     */
    public function __construct(string $cadena){
        $this->_cadena = $cadena;
        $this->_fechaHora = new DateTime();
    }


    /**
     * METODOS GETTER --> Metodos get para llamar a las propiedades
     *  -Los set no son necesarios ya que no vamos a modificar nada
     */

    /**
     *Getter para devolver la cadena 
     * @return string
     */
    public function getCadena ():string{
       return $this->_cadena;
    }

    /**
     * Getter para devolver la fecha 
     * @return DateTime
     */
    public function getFechaHora ():DateTime{
       return $this->_fechaHora;
    }

     /**
     * SOBRECARGA DINAMICA --> La desahibilitamos
      * @return void
     * @return mixed
     * @return bool
     * @return void
     */
    public function __set(string $name, mixed $value): void{
        throw new Exception("No existe la propiedad $name");
    }

    public function __get(string $name): mixed{
        throw new Exception("No existe la propiedad $name");
    }

    public function __isset(string $name): bool{
        return false;
    }

    public function __unset(string $name): void{
        throw new Exception("No existe la propiedad $name");
    }

}