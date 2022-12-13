import { Component } from '@angular/core';
import { FormControl, FormGroup } from '@angular/forms';
import { Actor } from 'src/app/model/actor';
import { Movie } from 'src/app/model/movie';
import { MovieActor } from 'src/app/model/movie-actor';
import { ActorService } from 'src/app/service/actor-service';
import { MovieService } from 'src/app/service/movie-service';
import { MovieActorService } from 'src/app/service/movieactor-service';
import { ActivatedRoute } from '@angular/router';
import { Subscription } from 'rxjs';

@Component({
  selector: 'app-edit-movieactor',
  templateUrl: './edit-movieactor.component.html',
  styleUrls: ['./edit-movieactor.component.css']
})
export class EditMovieactorComponent {
  
  constructor(private route: ActivatedRoute, private movieService:MovieService, private actorService: ActorService, 
    private movieActorService: MovieActorService) {}

  private routeSub: Subscription;
  movies: Movie[] = [];
  actors: Actor[] = [];
  obj: any;
  jsonContent: JSON;
  msg: any;
  processing: boolean;
  movieActor: MovieActor;
  id: number;


  editMovieActorForm = new FormGroup({
    movie:new FormControl(),
    actor: new FormControl()
  });

  ngOnInit() {
    this.routeSub = this.route.params.subscribe(params => {
      this.id = params['id']
    }); 

    this.movieActorService.getMovieActor(this.id).subscribe(
      {
        next: (respone) => {
          this.movieActor = respone;
        },    
        error: (msg) => { 
          this.msg = msg.error.msg;
        }
      }
    );

    this.movieService.getAllMovie().subscribe(
      {
        next: (respone) => {
          this.movies = respone;   
        },    
        error: (msg) => { 
          this.msg = msg.error.msg;
        }
      }
    );  
    
    this.actorService.getAllActor().subscribe(
      {
        next: (respone) => {
          this.actors = respone;    
        },    
        error: (msg) => { 
          this.msg = msg.error.msg;
        }
      }
    );  
  }

  onSubmit() {
    this.obj = {
      "id": this.id,
      "movieId": this.editMovieActorForm.get('movie')?.value,
      "actorId": this.editMovieActorForm.get('actor')?.value
    };

    this.jsonContent = <JSON>this.obj;

    this.processing = true;
    this.movieActorService.editMovieActor(this.id, this.jsonContent).subscribe(
      {
        next: (msg) => {
          this.msg = msg.msg;
          this.processing = false;
        },    
        error: (msg) => { 
          this.msg = msg.error.msg;
          this.processing = false;
        }
      }
    )
  }

  ngOnDestroy() {
    this.routeSub.unsubscribe();
  }
}
