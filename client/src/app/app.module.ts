import { NgModule } from '@angular/core';
import { HttpClientModule } from "@angular/common/http";
import { AppComponent } from './app.component';
import { SidebarComponent } from '@modules/sidebar/sidebar.component';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { HomeComponent } from "@modules/home/home.component";
import { ArtistComponent } from "@modules/artist/artist.component";
import { ReleaseComponent } from "@modules/release/release.component";
import { TrackComponent } from "@modules/track/track.component";
import { CommonModule } from "@angular/common";
import { ReactiveFormsModule } from "@angular/forms";
import { MatCardModule } from "@angular/material/card";
import { MatButtonModule } from "@angular/material/button";
import { NgxsModule } from "@ngxs/store";
import { AppState } from "../shared/app.state";
import { MatListModule } from '@angular/material/list';
import { MatProgressSpinnerModule } from '@angular/material/progress-spinner';
import { HeaderComponent } from '@modules/header/header.component';
import { LastFmComponent } from '@modules/lastfm/lastfm.component';


@NgModule({
    declarations: [
        AppComponent,
        SidebarComponent,
        HomeComponent,
        ArtistComponent,
        ReleaseComponent,
        TrackComponent,
        HeaderComponent,
        LastFmComponent
    ],
    imports: [
        CommonModule,
        HttpClientModule,
        ReactiveFormsModule,
        MatCardModule,
        MatButtonModule,
        MatListModule,
        MatProgressSpinnerModule,
        BrowserAnimationsModule,
        NgxsModule.forRoot([AppState])
    ],
    providers: [],
    bootstrap: [AppComponent]
})
export class AppModule {
}
