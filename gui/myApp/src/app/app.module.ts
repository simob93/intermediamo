import { BrowserModule } from '@angular/platform-browser';
import { ErrorHandler, NgModule } from '@angular/core';
import { IonicApp, IonicErrorHandler, IonicModule, IonicPageModule } from 'ionic-angular';
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
import { ListItemComponent } from '../components/list-item/list-item';
import { CtaMenuComponent } from '../components/cta-menu/cta-menu';
import { LoginPage } from '../pages/login/login';
import { VincoliPage } from '../pages/vincoli/vincoli';
import { AllegatiPage } from '../pages/allegati/allegati';
import { RapportoPage } from '../pages/rapporto/rapporto';

import { StatusBar } from '@ionic-native/status-bar';
import { SplashScreen } from '@ionic-native/splash-screen';

import {Standard} from '../standard/standard';
import { AuthServiceProvider } from '../providers/auth-service/auth-service';
import { HttpClientModule } from '@angular/common/http';
import { ImmobileProvider } from '../providers/immobile/immobile';
import { RapportoProvider } from '../providers/rapporto/rapporto';


@NgModule({
  declarations: [
    MyApp,
    CtaMenuComponent,
    HomePage,
    ListPage,
    ListItemComponent,
    ContattiPage,
    EditContattoPage,
    MenuImmobilePage,
    DatiCostruzionePage,
    DatiGeneraliPage,
    ComposizioneEsternaPage,
    ComposizioneInternaPage,
    CardCheckComponent,
    LoginPage,
    VincoliPage,
    AllegatiPage,
    RapportoPage
    
  ],
  imports: [
    BrowserModule,
    HttpModule,
    HttpClientModule,
    //EditContattoPage,
    IonicModule.forRoot(MyApp),
    //IonicPageModule.forChild(EditContattoPage)
  ],
  bootstrap: [IonicApp],
  entryComponents: [
    MyApp,
    CtaMenuComponent,
    HomePage,
    ListPage,
    ListItemComponent,
    ContattiPage,
    EditContattoPage,
    MenuImmobilePage,
    DatiCostruzionePage,
    DatiGeneraliPage,
    ComposizioneEsternaPage,
    ComposizioneInternaPage,
    CardCheckComponent,
    LoginPage,
    VincoliPage,
    AllegatiPage,
    RapportoPage
  ],
  providers: [
    StatusBar,
    SplashScreen,
    Standard,
    {provide: ErrorHandler, useClass: IonicErrorHandler},
    AuthServiceProvider,
    ImmobileProvider,
    RapportoProvider,
    //AllegatiProvider,
    ]
})
export class AppModule {}
