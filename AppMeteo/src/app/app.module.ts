import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { HomeComponent } from './home/home.component';
import { AdminComponent } from './admin/admin.component';
import { UserComponent } from './user/user.component';
import { DxButtonModule, DxChartModule, DxDataGridModule, DxMapModule } from 'devextreme-angular';
import { HttpClientModule } from '@angular/common/http';
import { NgxSocialShareModule } from 'ngx-social-share';

@NgModule({
  declarations: [
    AppComponent,
    HomeComponent,
    AdminComponent,
    UserComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    DxDataGridModule,
    DxChartModule,
    DxMapModule,
    DxButtonModule,
    HttpClientModule,
    NgxSocialShareModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
