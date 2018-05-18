import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams } from 'ionic-angular';
import * as constants from '../../standard/costants';
import {EditContattoPage} from '../edit-contatto/edit-contatto';
import {MenuImmobilePage} from '../menu-immobile/menu-immobile';

import { Http, Headers, RequestOptions, Response } from '@angular/http';
import 'rxjs/add/operator/map';
import { LoginPage } from '../login/login';

/**
 * Generated class for the ContattiPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-contatti',
  templateUrl: 'contatti.html',
})
export class ContattiPage {

  listaContatti: any;
  constructor(
    public navCtrl: NavController, 
    public navParams: NavParams, 
    public http: Http) {
      
  }
  /**
   *  metodo che ritorna una lista completa di contatti, 
   *  precedentemente inseriti
   */
  getContatti(value = '') {
    let url = 'contatti/list';
    let params = {
      text: value,
      tree: 'T'
    }
    //validazione del token
    let headers = new Headers({ 'Authorization': 'Bearer '+ localStorage.getItem('token') });  
    let options = new RequestOptions({headers: headers, params: params});
    
    this.http.get(constants.API_URL + url, options).map(res => res.json()).subscribe(risposta => {
        this.listaContatti = risposta.data;
    }, error => {
      if (error.status === 401) {
          //mostrare messaggio di errore
          localStorage.setItem('login', 'F');
      }
    });
  }
  search(search) {
      this.getContatti(search.target.value);
  }
  /**
   * metodo che aggiunge alla
   * bara di navigazione la pagina di inserimento 
   * di un nuovo contatto
   */
  insertContatto() {
      this.navCtrl.push(EditContattoPage, {
        idContatto: false
      });
  }
  /**
   * metodo che gestisce il doppio click 
   * sul singolo item della lista, mando alla 
   * pagina "Scheda immobile"
   * @param contatto 
   */
  itemClick(contatto) { 
      this.navCtrl.push(MenuImmobilePage, {
          idContatto: contatto.id
      });
  }

  ionViewDidEnter() { 
    this.getContatti();
  }
}
