import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { AppComponent } from './app.component';
import { ListGenreComponent } from './genre/list-genre/list-genre.component';
import { HttpClientModule } from '@angular/common/http';
import { MenuComponent } from './menu/menu.component';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { AppRoutingModule } from './app-routing.module';
import { WelcomeComponent } from './welcome/welcome.component';
import { DeleteGenreComponent } from './genre/delete-genre/delete-genre.component';
import { NewGenreComponent } from './genre/new-genre/new-genre.component';
import { EditGenreComponent } from './genre/edit-genre/edit-genre.component';
import { ListMovieComponent } from './movie/list-movie/list-movie.component';
import { NewMovieComponent } from './movie/new-movie/new-movie.component';
import { DeleteMovieComponent } from './movie/delete-movie/delete-movie.component';
import { EditMovieComponent } from './movie/edit-movie/edit-movie.component';
import { ListActorComponent } from './actor/list-actor/list-actor.component';
import { DeleteActorComponent } from './actor/delete-actor/delete-actor.component';
import { EditActorComponent } from './actor/edit-actor/edit-actor.component';
import { NewActorComponent } from './actor/new-actor/new-actor.component';
import { ListMovieactorComponent } from './movieactor/list-movieactor/list-movieactor.component';
import { AddMovieactorComponent } from './movieactor/add-movieactor/add-movieactor.component';
import { EditMovieactorComponent } from './movieactor/edit-movieactor/edit-movieactor.component';
import { DeleteMovieactorComponent } from './movieactor/delete-movieactor/delete-movieactor.component';
import { ListMovieRegistryComponent } from './list-movie-registry/list-movie-registry.component';
import { ListActorRegistryComponent } from './list-actor-registry/list-actor-registry.component';

@NgModule({
  declarations: [
    AppComponent,
    ListGenreComponent,
    MenuComponent,
    WelcomeComponent,
    DeleteGenreComponent,
    NewGenreComponent,
    EditGenreComponent,
    ListMovieComponent,
    NewMovieComponent,
    DeleteMovieComponent,
    EditMovieComponent,
    ListActorComponent,
    DeleteActorComponent,
    EditActorComponent,
    NewActorComponent,
    ListMovieactorComponent,
    AddMovieactorComponent,
    EditMovieactorComponent,
    DeleteMovieactorComponent,
    ListMovieRegistryComponent,
    ListActorRegistryComponent
  ],
  imports: [
    BrowserModule,
    HttpClientModule,
    FormsModule,
    AppRoutingModule,
    ReactiveFormsModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
