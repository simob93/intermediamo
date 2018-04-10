import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams } from 'ionic-angular';
import { Http } from '@angular/http';
import * as constants from '../../standard/costants';
import 'rxjs/add/operator/map';
import {Standard} from '../../standard/standard';


/**
 * Generated class for the EditContattoPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-edit-contatto',
  templateUrl: 'edit-contatto.html'
})
export class EditContattoPage {
  titleBar: String = 'Modifica contatto'
  contatto:any = {};
  constructor(
    public navCtrl: NavController, 
    public navParams: NavParams, 
    public http: Http,
    public standard: Standard) {
  }

  clickBtnConfirm() { 
      let id = this.contatto.id;

      if (!this.standard.isEmpty(this.contatto.nome)) {
          this.contatto.nome =  this.contatto.nome.toUpperCase();
      }
      if (!this.standard.isEmpty(this.contatto.cognome)) {
        this.contatto.cognome =  this.contatto.cognome.toUpperCase();
      }
      if (this.standard.isEmpty(id)) {
        this.http.post(constants.API_URL + 'contatti/contatti_save.php', this.contatto).map(res => res.json()).subscribe(risposta => {
            this.standard.showErrorMessage(risposta.message);
        });
      }

  }

  ionViewDidLoad() { 
    
    if (!this.navParams.data.idContatto) {
        this.titleBar = 'Nuovo contatto';
    }
  }

}
