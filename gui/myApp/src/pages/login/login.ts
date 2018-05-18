import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams } from 'ionic-angular';
import { AuthServiceProvider } from '../../providers/auth-service/auth-service';
import { Standard } from '../../standard/standard';
import { HomePage } from '../home/home';

/**
 * Generated class for the LoginPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-login',
  templateUrl: 'login.html',
})
export class LoginPage {
  registerCredentials:any = {};
  /**
   * 
   * @param navCtrl 
   * @param navParams 
   * @param authService 
   * @param standard 
   */
  constructor(
    public navCtrl: NavController, 
    public navParams: NavParams, 
    public authService: AuthServiceProvider,
    public standard: Standard ) {
  }
  /**
   * metodo per il login dell'operatore 
   * nel portale
   */
  doLogin() {
    this.authService.login(this.registerCredentials).subscribe(risp => {
        this.standard.showErrorMessage(risp['message']);
        if (risp['success']) {
            localStorage.setItem('token', risp['data']);
            localStorage.setItem('login', 'T');
            //faccio partire il mnu del progetto
            this.navCtrl.setRoot(HomePage);
        } else {
          localStorage.setItem('token', null);
          localStorage.setItem('login', 'F');
        }
    });
  }

  ionViewDidLoad() {
      if(localStorage.getItem('login') === 'T') {
        this.navCtrl.setRoot(HomePage);
      }
  }

}
