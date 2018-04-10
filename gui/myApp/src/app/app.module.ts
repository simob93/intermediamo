import { BrowserModule } from '@angular/platform-browser';
import { ErrorHandler, NgModule } from '@angular/core';
import { IonicApp, IonicErrorHandler, IonicModule } from 'ionic-angular';
import { HttpModule } from '@angular/http';

import { MyApp } from './app.component';
import { HomePage } from '../pages/home/home';
import { ContattiPage } from '../pages/contatti/contatti';
import { EditContattoPage } from '../pages/edit-contatto/edit-contatto';
import { ListPage } from '../pages/list/list';
import { MenuImmobilePage } from '../pages/menu-immobile/menu-immobile';
import { DatiCostruzionePage } from '../pages/dati-costruzione/dati-costruzione';
import { DatiGeneraliPage } from '../pages/dati-generali/dati-generali';
import { ComposizioneEsternaPage } from '../pages/composizione-esterna/composizione-esterna';
import { ComposizioneInternaPage } from '../pages/composizione-interna/composizione-interna';
import { CardCheckComponent } from '../components/card-check/card-check';
import { LoginPage } from '../pages/login/login';


import { StatusBar } from '@ionic-native/status-bar';
import { SplashScreen } from '@ionic-native/splash-screen';

import {Standard} from '../standard/standard';
import { AuthServiceProvider } from '../providers/auth-service/auth-service';
import { HttpClientModule } from '@angular/common/http'; 

@NgModule({
  declarations: [
    MyApp,
    HomePage,
    ListPage,
    ContattiPage,
    EditContattoPage,
    MenuImmobilePage,
    DatiCostruzionePage,
    DatiGeneraliPage,
    ComposizioneEsternaPage,
    ComposizioneInternaPage,
    CardCheckComponent,
    LoginPage
    
  ],
  imports: [
    BrowserModule,
    HttpModule,
    HttpClientModule,
    IonicModule.forRoot(MyApp),
  ],
  bootstrap: [IonicApp],
  entryComponents: [
    MyApp,
    HomePage,
    ListPage,
    ContattiPage,
    EditContattoPage,
    MenuImmobilePage,
    DatiCostruzionePage,
    DatiGeneraliPage,
    ComposizioneEsternaPage,
    ComposizioneInternaPage,
    CardCheckComponent,
    LoginPage
  ],
  providers: [
    StatusBar,
    SplashScreen,
    Standard,
    {provide: ErrorHandler, useClass: IonicErrorHandler},
    AuthServiceProvider,
    ]
})
export class AppModule {}
