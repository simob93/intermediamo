import { Component } from '@angular/core';
import { NavController, IonicPage } from 'ionic-angular';

import { CtaMenuComponent } from '../../components/cta-menu/cta-menu'
import { EditContattoPage } from '../edit-contatto/edit-contatto';
import { ContattiPage } from '../contatti/contatti'
import { RapportoPage } from '../rapporto/rapporto'

@Component({
  selector: 'page-home',
  templateUrl: 'home.html'
})
export class HomePage {
  tmp: {}
  constructor(public navCtrl: NavController) {
    
  }
  onClickButton(screen:string) {
    this.tmp = {
      'EditContattoPage': EditContattoPage,
      'ContattiPage': ContattiPage,
      'RapportoPage': RapportoPage
    }
    this.navCtrl.push(this.tmp[screen]);
  }

}
