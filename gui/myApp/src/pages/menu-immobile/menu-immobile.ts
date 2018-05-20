import { Component } from '@angular/core';
import { 
  IonicPage,
  NavController,
  NavParams } from 'ionic-angular';

import { DatiCostruzionePage } from '../../pages/dati-costruzione/dati-costruzione';
import { DatiGeneraliPage } from '../../pages/dati-generali/dati-generali';
import { ComposizioneEsternaPage } from '../../pages/composizione-esterna/composizione-esterna';
import { ComposizioneInternaPage } from '../../pages/composizione-interna/composizione-interna';

import { 
  ImmobileProvider, 
  ImmobileForm } from '../../providers/immobile/immobile';

import { AllegatiPage } from '../allegati/allegati';
import {Standard} from '../../standard/standard';


/**
 * Generated class for the MenuImmobilePage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-menu-immobile',
  templateUrl: 'menu-immobile.html',
})


export class MenuImmobilePage {
  object: ImmobileForm = new ImmobileForm();
  enableAllegati:boolean = false;
  menuImmobile: Array<{titolo:String, page: any, img:any}>;  

  constructor(
    public navCtrl: NavController, 
    public navParams: NavParams,
    public immobileService:ImmobileProvider,
    public standard:Standard) {
      
    //menu "Scheda immobile" 
    this.menuImmobile = [
      {
        titolo: 'Dati di costruzione',
        page: DatiCostruzionePage,
        img: 'costruzione'
      },
      {
        titolo: 'Dati generali',
        page: DatiGeneraliPage,
        img: 'generali'
      },
      {
        titolo: 'Composizione esterna',
        page: ComposizioneEsternaPage,
        img: 'esterna'
      },
      {
        titolo: 'Composizione interna',
        page: ComposizioneInternaPage,
        img: 'interna'
      },
      {
        titolo: 'Riscaldamento e varie',
        page: null,
        img: 'riscaldamento'
      },
      {
        titolo: 'Vincoli',
        page: null,
        img: 'vincoli'
      },
      {
        titolo: 'Allegati',
        page: AllegatiPage,
        img: 'allegati',

      }
    ]
}
/**
 *  metodo per il salvataggio dell'immobile,
 *  le tab "dati generali e datiCostruzione" 
 *  compongono il record di testata
 */
clickBtnConfirm() {
  
  let idContatto = parseInt(this.navParams.get('idContatto'));
  Object.assign(this.object, {idContatto});

  this.immobileService.saveImmobile(this.object).subscribe(res => {

      this.standard.showErrorMessage(res['message']);
      const id = res['data'];
      //abilito il bottone allegati
      this.enableAllegati = id !== null ;
      Object.assign(this.object, {id});
      
  }, error => {
    //errore di sessione
    if (error.status === 401) {
        localStorage.setItem('login', 'F');
    }
  });
}
/**
 * 
 * @param menuItem 
 */
  itemClick(menuItem) {
    
    this.navCtrl.push(menuItem.page, {
        valoriForm: this.object,
        /**
         * funzione di callback che viene eseguita ogni 
         * volta che viene richiamo il "back button"
         */
        callbackfn: (params) => {
            Object.assign(this.object, params)
        }
    });

  }

  ionViewDidLoad() {
    
    let record = this.navParams.get('record'); 

    if (record) {
       let { idImmobile } = record;
       if (idImmobile) {
          this.immobileService.getById(idImmobile).subscribe(response => {
              
              this.object = response['data'][0];
              this.enableAllegati = true;
          });
      }
    }
  }

}
